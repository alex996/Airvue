<template>
	<div>
		<airport-finder></airport-finder>

		<flight-finder></flight-finder>

		<flight-manager :flights="flights"></flight-manager>
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
				trip: null	
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
		},
		computed: {
			flights() {
				if (! this.trip) {
					return [];
				}

				return this.trip.flights;
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