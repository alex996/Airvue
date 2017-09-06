<template>
	<div :class="{ 'modal': true, 'is-active': active }">
		<div class="modal-background" @click="$emit('closed')"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">
					Airports
				</p>
				<button class="delete" aria-label="close" @click="$emit('closed')"></button>
			</header>
			<section class="modal-card-body is-flex is-centered">
				<table class="table">
					<thead>
						<tr>
							<th>ICAO</th>
							<th>IATA</th>
							<th>Name</th>
							<th>City</th>
							<th>Country</th>
							<th>Latitude</th>
							<th>Longitude</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="airport in airports.data" :key="airport.icao">
							<td>
								<span class="tag is-primary">{{ airport.icao }}</span>
							</td>
							<td>
								<span class="tag is-light" v-show="airport.iata">{{ airport.iata }}</span>
							</td>
							<td>{{ airport.name }}</td>
							<td>{{ airport.city }}</td>
							<td>{{ airport.country }}</td>
							<td>{{ airport.lat }}</td>
							<td>{{ airport.long }}</td>
						</tr>
						<tr v-if="! airports.data.length">
							<td colspan="7" class="has-text-centered">
								<i>Sorry, we couldn't find any airports for this search.</i>
							</td>
						</tr>
					</tbody>
				</table>
			</section>
			<footer class="modal-card-foot is-flex is-centered">
				<div class="field is-grouped is-grouped-centered">
				  <div class="control">
				    <button class="button is-primary" @click="goBack" :disabled="! airports.links.prev">Previous</button>
				  </div>
				  <div class="control">
				    <button class="button is-primary" @click="goForward" :disabled="! airports.links.next">Next</button>
				  </div>
				</div>
			</footer>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'active', 'airports'
		],
		methods: {
			goBack() {
				this.$emit('load', this.airports.links.prev);
			},
			goForward() {
				this.$emit('load', this.airports.links.next);
			}
		}
	}
</script>

<style lang="scss" scoped>
	.modal-card {
		min-width: 1000px;
	}
</style>