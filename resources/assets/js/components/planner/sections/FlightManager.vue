<template>
	<section class="section">
		<h1 class="title">
			<span class="icon is-medium">
				<i class="fa fa-globe" aria-hidden="true"></i>
			</span>

			Manage Flights
		</h1>
		<div class="box">
			<form @submit.prevent="addFlight">
				<div class="notification is-danger" v-show="error">
					<button class="delete" @click.prevent="error = ''"></button>
					<strong>Snap!</strong> {{ error }}
				</div>
				<div class="columns">
					<div class="column">
						<div class="field">
							<label class="label">Flight Number</label>
							<div class="control">
								<input class="input" v-model="number" placeholder="ex: 02AWSV" required>
							</div>
							<p class="help"><i>Hint</i>: use the 'Find a Flight' tool above and copy-paste the flight number to the input box.</p>
						</div>
					</div>
					<div class="column is-1 is-flex is-centered">
						<div class="field">
							<button class="button is-large is-primary">
								<span class="icon is-large">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</span>
							</button>
						</div>
					</div>			
				</div>
			</form>

			<hr v-show="trip.flights.length">

			<flight v-for="flight in trip.flights" :key="flight.number" :flight="flight" @deleted="deleteFlight"></flight>
		</div>
	</section>
</template>

<script>
 	import Flight from './modules/Flight';

	export default {
		components: {
			Flight
		},
		data() {
			return {
				trip: {
					uid: null,
					flights: []
				},
				number: '',
				error: '',
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
			},
			addFlight() {
				this.error = '';

				axios.post('/api/trips/' + this.trip.uid + '/flights/' + this.number)
					.then((response) => {
						this.trip.flights.push(response.data.data);
					})
					.catch((error) => {
						if (error.response.status === 404) {
							this.error = `We could not find any flight matching '${this.number}'. Sorry about that!`;
						} 
						else if (error.response.status === 400) {
							this.error = `Flight '${this.number}' has already been added to the trip!`;
						}
						else {
							this.error = 'Something terrible just happened. Please refresh the page and try again.';
						}
					})
					.then(() => {
						this.number = '';
					});
			},
			deleteFlight(flight) {
				axios.delete('/api/trips/' + this.trip.uid + '/flights/' + flight.number)
					.then((response) => {
						this.trip.flights = this.trip.flights.filter(someFlight =>
							someFlight.number !== flight.number
						);
					});
			}
		}
	}
</script>

<style lang="scss">
	
</style>