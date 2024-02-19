<?php

	class TavernItemsView extends AbstractView {
		public function displayMobile(array $do_list) {
			header('Content-Type: application/json');
		
			echo json_encode($do_list);
		}
		
		public function displayWeb(
			array $do_list,
			array $item_do_list,
			array $tavern_items_do_list
		) {
			?>
				<?php $this->getWebHeader(); ?>
				
				<?php
					foreach($do_list as $do) {
						?>
							<div style="border:1px solid #000;">
								<div>
									<h3>
										<a href="<?php echo($do->website_url); ?>" target="_blank">
											<?php echo($do->display_name); ?>
										</a>
									</h3>
									<h4>Tárgyak</h4>
									<div>
										<?php
											foreach($item_do_list as $item_do) {
										?>
											<a href="/tavernraid/web/image/upload">
												<?php
													$item_image_file_name = 'item_' . $item_do->id . '_icon.png';
													if (
														file_exists(
															TavernRaidRequestResponseHelper::$root . 
															'/cdn/' . 
															$item_image_file_name
														)
													) {
														echo(
															'<img style="width:20px;height:20px;" src="' . 
															TavernRaidRequestResponseHelper::$url_root . 
															'/cdn/' . 
															$item_image_file_name . 
															'" />'
														);
													}
													else {
														echo('X');
													}
												?>
											</a>
											<form action="" method="post" style="display:inline;">
												<input
													style="width:20%;"
													name="tavern_item_price_set"
													type="submit"
													value="Ár beállítása" />
												<input
													name="tavern_id"
													type="hidden"
													value="<?php echo($do->id); ?>" />
												<input
													name="item_id"
													type="hidden"
													value="<?php echo($item_do->id); ?>" />
												<input
													style="width:10%"
													name="price"
													type="input"
													value="<?php
														foreach ($tavern_items_do_list as $tavern_items_do) {
															if (
																$do->id === $tavern_items_do->tavern_id AND
																$item_do->id === $tavern_items_do->item_id
															) {
																echo($tavern_items_do->price);
															}
														}
													?>" />
											</form>
											<label style="display:inline;">
												<?php
													echo($item_do->name);
													echo(" | ");
													if ($item_do->is_alcoholic) {
														echo("Alkoholos");
													}
													else {
														echo("<strong>Alkoholmentes</strong>");
													}
													echo('(#' . $item_do->id . ')');
												?>
											</label>
											<br clear="all" />
										<?php
											}
										?>
									</div>
								</div>
							</div>
							<br clear="all" />
						<?php
					}
				?>
				
				<?php $this->getWebFooter(); ?>
			<?php
		}
	}
?>