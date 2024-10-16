// store.js

import { createStore } from 'vuex';


const store = createStore({

    state() {

        return {

            favorites: []

        }

    },

    mutations: {

        toggleFavorite(state, product) {

            const index = state.favorites.findIndex(fav => fav.id === product.id);

            if (index !== -1) {

                state.favorites.splice(index, 1); // Remove from favorites

            } else {

                state.favorites.push(product); // Add to favorites

            }

        }

    },

    actions: {

        toggleFavorite({ commit }, product) {

            commit('toggleFavorite', product);

        }

    },

    getters: {

        favorites: (state) => state.favorites

    }

});


export default store;
