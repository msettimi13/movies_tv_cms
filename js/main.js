// import Vue here
import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.esm.browser.js'

import MovieThumb from './components/TheMovieThumb.js';

(() => {
    const myVM = new Vue({
        data: {
            movies: [],
            filteredMovies: []
        },

        created: function() {
            fetch('../index.php')
            .then(res => res.json())
            .then(data => this.movies = this.filteredMovies = data)
        .catch(err => console.error(err));
        }, 
        
        methods: {
            filterMovies(genre) {
                if (genre === 'all') { this.filteredMovies = this.movies 
                return; }
                this.filteredMovies = this.movies.filter(movie => movie.genre_name.toLowerCase().includes(genre));
                debugger;
            }
        },

        components: {
            moviethumb: MovieThumb
        }

    }).$mount("#app");
})();
