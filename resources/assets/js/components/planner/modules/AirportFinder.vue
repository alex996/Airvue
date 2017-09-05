<template>
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
								<input class="input" placeholder="YYYY-MM-DD">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label class="label">City</label>
							<div class="control">
								<input class="input" placeholder="ex: Montreal, CA">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label class="label">Country</label>
							<div class="control">
								<input class="input" placeholder="ex: Toronto, CA">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<button class="button is-large is-primary">
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
</template>

<script>
	export default {
		
	}
</script>

<style lang="scss">
	
</style>