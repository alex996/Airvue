<template>
	<div>
		<airport-finder></airport-finder>

		<flight-finder></flight-finder>

		<flight-manager :flights="trip.flights"></flight-manager>
	</div>
</template>

<script>
	import AirportFinder from './sections/AirportFinder';
	import FlightFinder from './sections/FlightFinder';
	import FlightManager from './sections/FlightManager';

	export default {
		components: {
			AirportFinder, FlightFinder, FlightManager
		},
		data() {
			return {
				trip: {
					uid: null,
					flights: []
				}	
			};
		},
		created() {
			this.makeTrip();
		},
		methods: {
			makeTrip() {
				axios.post('/api/trips')
					.then((response) => {
						this.trip = response.data.data;
					})
					.catch((error) => {
						console.log(error.response.data);
					});
			}
		}
	}
</script>

<style lang="scss">
	.is-flex.is-centered {
		justify-content: center;
		align-items: center;
	}
</style>