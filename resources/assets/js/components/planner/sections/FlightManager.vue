<template>
	<section class="section">
		<h1 class="title">
			<span class="icon is-medium">
				<i class="fa fa-globe" aria-hidden="true"></i>
			</span>

			Manage Flights
		</h1>
		<div class="box">
			<p v-show="! flights.length" class="has-text-centered">
				<i>You do not have any planned flights.</i>
			</p>

			<flight v-for="flight in flights" :key="flight.number">
			</flight>
		</div>
	</section>
</template>

<script>
	import Flight from './entities/Flight'

	export default {
		components: {
			Flight
		},
		props: [
			'flights'
		]
	}
</script>

<style lang="scss">
	
</style>