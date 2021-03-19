export default {
    name: "TheMovieThumb",

    props: ['movie'],

    template:
    `
    <section>
        <h1>{{ movie.movies_title }}<h1>
    </section>
    `
}