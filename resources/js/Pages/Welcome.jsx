import { Link, Head } from '@inertiajs/react';
import MovieList from "@/Pages/MovieList";

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <>
            <Head title="Movie's catalog" />

            <MovieList />
        </>
    );
}
