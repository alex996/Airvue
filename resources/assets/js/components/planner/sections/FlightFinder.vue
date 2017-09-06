<template>
	<section class="section">
		<h1 class="title">
			<span class="icon is-medium">
				<i class="fa fa-plane" aria-hidden="true"></i>
			</span>

			Find a Flight
		</h1>
		<div class="box">
			<form>
				<div class="columns">
					<div class="column">
						<div class="field">
							<label class="label">From (City, Country)</label>
							<div class="control">
								<input class="input" v-model="flight.from" placeholder="ex: Montreal, CA">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label class="label">To (City, Country)</label>
							<div class="control">
								<input class="input" v-model="flight.to" placeholder="ex: Toronto, CA">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label class="label">Airline</label>
							<div class="control">
								<input class="input" v-model="flight.airline" placeholder="ex: Air Canada">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label class="label">Date</label>
							<div class="control">
								<input class="input" v-model="flight.date" placeholder="YYYY-MM-DD">
							</div>
						</div>
					</div>
					<div class="column is-1 is-flex is-centered">
						<div class="field">
							<button class="button is-large is-primary" @click.prevent="findFlights()">
								<span class="icon is-large">
									<i class="fa fa-search" aria-hidden="true"></i>
								</span>
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<flights :flights="flights" :active="showFlights" @closed="showFlights = false" @load="findFlights"></flights>
	</section>
</template>

<script>
	import Flights from './modules/Flights';

	export default {
		components: {
			Flights
		},
		data() {
			return {
				flight: {
					from: '',
					to: '',
					airline: '',
					date: ''
				},
				flights: {
					data: [],
					links: [],
					meta: []
				},
				showFlights: false
			}
		},
		methods: {			
			findFlights(url) {
				if (! url)
					url = '/api/flights';

				url = this.parameterize(url)

				axios.get(url)
					.then((response) => {
						this.flights = response.data;

						this.showFlights = true;
					});
			},
			parameterize(url) {
				if (! url.includes('?'))
					url += '?';
				else
					url += '&';

				if (this.flight.from)
					url += `from=${this.flight.from}&`;

				if (this.flight.to)
					url += `to=${this.flight.to}&`;

				if (this.flight.airline)
					url += `airline=${this.flight.airline}&`;

				if (this.flight.date)
					url += `date=${this.flight.date}&`;

				return url;
			}
		}
	}
</script>

<style lang="scss">
	
</style>