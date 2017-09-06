<template>
	<div>
		<section class="section">
			<h1 class="title">
				<span class="icon is-medium">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</span>

				Find an Airport
			</h1>
			<div class="box">
				<form>
					<div class="columns">
						<div class="column">
							<div class="field">
								<label class="label">Name</label>
								<div class="control">
									<input class="input" v-model="airport.name" placeholder="ex: Calgary International Airport">
								</div>
							</div>
						</div>
						<div class="column">
							<div class="field">
								<label class="label">City</label>
								<div class="control">
									<input class="input" v-model="airport.city" placeholder="ex: Calgary">
								</div>
							</div>
						</div>
						<div class="column">
							<div class="field">
								<label class="label">Country</label>
								<div class="control">
									<input class="input" v-model="airport.country" placeholder="ex: CA">
								</div>
							</div>
						</div>
						<div class="column is-1 is-flex is-centered">
							<div class="field">
								<button class="button is-large is-primary" @click.prevent="findAirports()">
									<span class="icon is-large">
										<i class="fa fa-search" aria-hidden="true"></i>
									</span>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>

		<airports :airports="airports" :active="showAirports" @closed="showAirports = false" @load="findAirports"></airports>
	</div>
</template>

<script>
	import Airports from './modules/Airports';

	export default {
		components: {
			Airports
		},
		data() {
			return {
				airport: {
					name: '',
					city: '',
					country: ''
				},
				airports: {
					data: [],
					links: [],
					meta: []
				},
				showAirports: false
			}
		},
		methods: {			
			findAirports(url) {
				if (! url)
					url = '/api/airports';

				url = this.parameterize(url)

				axios.get(url)
					.then((response) => {
						this.airports = response.data;

						this.showAirports = true;
					});
			},
			parameterize(url) {
				if (! url.includes('?'))
					url += '?';
				else
					url += '&';

				if (this.airport.name)
					url += `name=${this.airport.name}&`;

				if (this.airport.city)
					url += `city=${this.airport.city}&`;

				if (this.airport.country)
					url += `country=${this.airport.country}`;

				return url;
			}
		}
	}
</script>

<style lang="scss">
	
</style>