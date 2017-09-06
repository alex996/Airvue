<template>
	<div>
		<airport-finder></airport-finder>

		<flight-finder></flight-finder>

		<flight-manager></flight-manager>
	</div>
</template>

<script>
	import AirportFinder from './sections/AirportFinder';
	import FlightFinder from './sections/FlightFinder';
	import FlightManager from './sections/FlightManager';

	export default {
		components: {
			AirportFinder, FlightFinder, FlightManager
		}
	}
</script>

<style lang="scss">
	.is-flex.is-centered {
		justify-content: center;
		align-items: center;
	}
</style>