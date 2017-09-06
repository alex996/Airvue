<template>
	<section class="hero is-fullheight is-primary is-bold">
		<div class="hero-body">
			<div class="container">
				<template v-if="active">
					<app></app>
				</template>
				<div class="has-text-centered" v-else>
					<h1 class="title is-1 is-spaced">
						Airvue
					</h1>
					<h2 class="subtitle">
						<em>Plan your Dream Trip today</em>
					</h2>
					<button class="button is-primary is-inverted is-outlined is-large is-cta" @click="active = true">
						Get Started Now
					</button>
				</div>
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
				active: false
			};
		}
	}
</script>

<style lang="scss">
	button.is-cta {
		margin-top: 10px;
	}
</style>
