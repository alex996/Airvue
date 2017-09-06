<template>
	<div :class="{ 'modal': true, 'is-active': active }">
		<div class="modal-background" @click="$emit('closed')"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">
					Flights
				</p>
				<button class="delete" aria-label="close" @click="$emit('closed')"></button>
			</header>
			<section class="modal-card-body is-flex is-centered">
				<table class="table">
					<thead>
						<tr>
							<th>Number</th>
							<th>From</th>
							<th>To</th>
							<th>Airline</th>
							<th>Date</th>
							<th>Duration</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="flight in flights.data" :key="flight.number">
							<td>
								<span class="tag is-primary">{{ flight.number }}</span>
							</td>
							<td>
								{{ flight.origin.city }}, {{ flight.origin.country }}
								<span class="tag is-light" :title="flight.origin.name">{{ flight.origin.icao }}</span>
							</td>
							<td>
								{{ flight.destination.city }}, {{ flight.destination.country }}
								<span class="tag is-light" :title="flight.destination.name">{{ flight.destination.icao }}</span>
							</td>
							<td>{{ flight.airline }}</td>
							<td>{{ flight.departed_at.date.substring(0, 16) }}</td>
							<td>{{ flight.hours }}h {{ flight.minutes }}m</td>
						</tr>
						<tr v-if="! flights.data.length">
							<td colspan="6" class="has-text-centered">
								<i>Sorry, we couldn't find any flights for this search.</i>
							</td>
						</tr>
					</tbody>
				</table>
			</section>
			<footer class="modal-card-foot is-flex is-centered">
				<div class="field is-grouped is-grouped-centered">
				  <div class="control">
				    <button class="button is-primary" @click="goBack" :disabled="! flights.links.prev">Previous</button>
				  </div>
				  <div class="control">
				    <button class="button is-primary" @click="goForward" :disabled="! flights.links.next">Next</button>
				  </div>
				</div>
			</footer>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'active', 'flights'
		],
		methods: {
			goBack() {
				this.$emit('load', this.flights.links.prev);
			},
			goForward() {
				this.$emit('load', this.flights.links.next);
			}
		}
	}
</script>

<style lang="scss" scoped>
	.modal-card {
		min-width: 1000px;
	}
</style>