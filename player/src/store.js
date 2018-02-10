import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
	state : {
		token : false,
		score : 0,
		earned : 0,
		time : 0,
	},
	mutations : {
		setToken(state,token) {
			state.token = token;
		},
		setScore(state,score) {
			state.score += score;
		},
		resetScore(state,score) {
			state.score = 0;
		},
		setEarned(state,earned) {
			state.earned = earned;
		},
		setTime(state,time) {
			state.time = time;
		},
		initialiseStore(state) {
			if(localStorage.getItem('store')) {
				this.replaceState(
					Object.assign(state, JSON.parse(localStorage.getItem('store')))
				);
			}
		}
	}
})
