<template>
	<article class="media">
		<hr>
		<div class="media-content">
			<div class="columns">
				<div class="column is-2">
					<div class="content">
						<p>
							<strong class="has-text-primary">Number</strong>:
							<br>
							{{ flight.number }}
						</p>
						<p>
							<strong class="has-text-primary">Airline</strong>:
							<br>
							{{ flight.airline }}
						</p>
					</div>
				</div>
				<div class="column is-5">
					<div class="content">
						<p>
							<strong class="has-text-primary">From</strong>: {{ flight.origin.city }}, {{ flight.origin.country }}
							<br>
							<small>{{ flight.origin.name }}</small> <small>({{ flight.origin.icao }})</small>
						</p>
						<p>
							<strong class="has-text-primary">To</strong>: {{ flight.destination.city }}, {{ flight.destination.country }}
							<br>
							<small>{{ flight.destination.name }}</small> <small>({{ flight.destination.icao }})</small>
						</p>
					</div>
				</div>
				<div class="column is-3">
					<div class="content">
						<p>
							<strong class="has-text-primary">Departure</strong>:
							<br>
							{{ flight.departed_at.date.substring(0, 16) }}
						</p>
						<p>
							<strong class="has-text-primary">Arrival</strong>:
							<br>
							{{ flight.arrived_at.date.substring(0, 16) }}
						</p>
					</div>
				</div>
				<div class="column is-2">
					<div class="content">
						<p>
							<strong class="has-text-primary">Duration</strong>:
							<br>
							{{ flight.hours }}h {{ flight.minutes }}m
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="media-right">
			<button class="button is-danger is-large" @click="$emit('deleted', flight)">
				<span class="icon is-large">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</span>
			</button>
		</div>
	</article>
</template>

<script>
	export default {
		props: [
			'flight'
		]
	}
</script>

<style lang="scss" scoped>
	article.media {
		margin: 20px 0;
	}
</style>