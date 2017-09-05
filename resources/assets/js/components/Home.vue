<template>
	<section class="hero is-fullheight is-primary is-bold has-text-centered">
		<div class="hero-body">
			<div class="container">
				<template v-if="appActive">
					<app></app>
				</template>
				<template v-else>
					<h1 class="title is-1 is-spaced">
						Airvue
					</h1>
					<h2 class="subtitle">
						<em>Plan your Dream Trip today</em>
					</h2>
					<button class="button is-primary is-inverted is-outlined is-large is-cta" @click="appActive = true">
						Get Started Now
					</button>
				</template>
			</div>
		</div>
	</section>
</template>

<script>
	import App from './planner/App';

	export default {
		components: {
			App
		},
		data() {
			return {
				appActive: false
			};
		},
		methods: {
			/*makeTrip() {
				axios.post('/api/trips')
					.then((response) => {
						this.trip = response.data;
					})
					.catch((error) => {
						console.log(error.response.data);
					});
			}*/			
		}
	}
</script>

<style lang="scss">
	button.is-cta {
		margin-top: 10px;
	}
</style>
