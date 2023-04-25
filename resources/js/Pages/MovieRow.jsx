import {Link} from "@inertiajs/react";

export default function MovieRow({ movie }) {
    return (
        <div>
            {movie.id} - {movie.title}
        </div>
    );
}
