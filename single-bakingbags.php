<?php get_header(); ?>
	<div class="main-content-wrapper bakingbags contact">
		<div class="post-thumbnail-single">
			<?php the_post_thumbnail('thumbnailimagesingle'); ?>
		</div>

		<h3>Deze baking bag kopen? Vul het onderstaande formulier in en ik neem zo snel mogelijk content met je op!</h3>

		<form action="/order-success" class="baking-bag-form">
			<div class="form-control">
				<label for="name">Naam:</label>
				<input name="name" type="text">
			</div>
			<div class="form-control">
				<label for="email">Email:</label>
				<input name="email" type="email">
			</div>
			<div class="form-control">
				<label for="address">Straatnaam en huisnummer:</label>
				<input name="address" type="text">
			</div>
			<div class="form-control">
				<label for="city">Plaats:</label>
				<input name="city" type="text">
			</div>
			<div class="form-control">
				<label for="postcode">Postcode:</label>
				<input name="postcode" type="text">
			</div>
			<div class="form-control">
				<label for="amount">Aantal:</label>
				<select name="amount" id="amount">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
			</div>

			<button class="btn btn-pink" type="submit" id="baking_bag_buy" name="baking_bag_buy">Klik hier om te kopen!</button>
		</form>
	</div>
<?php get_footer(); ?>
