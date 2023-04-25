import MovieRow from "@/Pages/MovieRow";
import {Component} from "react";

class MovieList extends Component {
    constructor(props) {
        super(props)

        this.state = {
            movies: [],
            searchQuery: null,
            searchInTitle: true,
            searchInDescription: false,
            year: null,
            genres: null,
            offset: 0,
            limit: 10,
            searching: false,
            showBtnLoadNext: true,
            loading: false,
            years: this.getYears(),
        }

        this.search = this.search.bind(this)
        this.loadNext = this.loadNext.bind(this)
    }

    componentDidMount() {
        this.loadNext()
    }

    getYears() {
        let years = [];
        for(let year = (new Date()).getFullYear(); year >= 1900; year--)  {
            years.push(year)
        }
        return years
    }

    search(e) {
        e.preventDefault();

        // Read the form data
        const form = e.target;
        const formData = new FormData(form);

        this.setState({
            movies: [],
            searchQuery: formData.get('searchQuery'),
            year: formData.get('year'),
        })

        this.loadNext()
    }

    loadNext() {
        this.setState({
            loading: true,
        })

        this.getMovies()
    }

    getMovies() {
        let searchParams = {
            offset: this.state.movies.length,
            limit: this.state.limit
        }

        if (this.state.searchQuery) {
            searchParams.searchQuery = this.state.searchQuery
            searchParams.searchInTitle = this.state.searchInTitle
            searchParams.searchInDescription = this.state.searchInDescription
        }

        if (this.state.year) {
            searchParams.year = this.state.year
        }

        if (this.state.genres) {
            searchParams.genres = this.state.genres
        }

        axios({
            method: 'GET',
            url: 'http://localhost/api/movies',
            params: searchParams
        })
        .then(res => {
            this.setState({
                loading: false,
                showBtnLoadNext: res.data.length>0,
                movies: this.state.movies.concat(res.data)
            })
        });
    }

    render() {
        return (
            <>
                <form onSubmit={this.search}>
                    <label>
                        Поиск: <input name="searchQuery"  />
                    </label>
                    <div>
                    <label><input type={"checkbox"} name={"searchInTitle"} />Название</label>
                    <label><input type={"checkbox"} name={"searchInDescription"} />Описание</label>
                    </div>
                    <hr />
                    <label>Год:
                        <select name={"year"}>
                            <option value=''>---</option>
                            {this.state.years.map((year) => {
                                return (
                                    <option key={"year-" + year} value={year}>{year}</option>
                                )
                            })}
                        </select>
                    </label>
                    <hr />
                    <button type="reset">Reset form</button>
                    <button type="submit">Submit form</button>
                </form>

                {this.state.movies.length && this.state.movies.map((movie, i) => {
                    return (
                        <MovieRow
                            key={i}
                            movie={movie}
                        />
                    );
                })}
                {!this.state.loading && this.state.showBtnLoadNext && <button onClick={this.loadNext}>Еще...</button>}
                {this.state.loading && <button >Загрузка...</button>}
            </>
        );
    }
}

export default MovieList
