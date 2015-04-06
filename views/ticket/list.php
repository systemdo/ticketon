<?php 

use yii\helpers\Url;

?>
<div class="col-md-6 grid-ticket">
	<div class="row">
		<div class="accordion">
		<h3><?php echo Yii::t('app', 'Ticket Assigined');?></h3>
			
		  <table class="table table-bordered">
		  		
		    <?php foreach($c_t as $key => $t){ 
		    ?>
					<tr class="status <?php echo $t->getColorTicket()?>">
						<td>
							<?php echo $t->clients->name.' '. $t->type->problem?>
						</td>
						<td>
							<?php echo $t->date?>
						</td>
						<td class="see-ticket">
							<a href="<?php echo Url::to(['ticket/view', 'id' => $t->id])?>">
								<button type="button" class="btn btn-info">
									<span class="glyphicon glyphicon-plus"></span> 
								</button>
							</a>
						</td>
					</tr>

			<?php } ?>
		  </table>			
		</div><!--acordion-->
		<!--<nav>
		  <ul class="pagination">
		    <li>
		      <a href="#" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <li><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li>
		      <a href="#" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>-->
	</div><!--row-->
</div>

<div class="col-md-6 grid-ticket">
	<div class="row">
		<div class="accordion">
		<h3><?php echo Yii::t('app', 'Ticket Created');?></h3>
			
		  <table class="table table-bordered">
		  		
		    <?php foreach($a_s as $key => $t){ 
		    ?>
					<tr class="status <?php echo $t->getColorTicket()?>">
						<td>
							<?php echo $t->clients->name.' '. $t->type->problem?>
						</td>
						<td class="see-ticket">
							<a href="<?php echo Url::to(['ticket/view', 'id' => $t->id])?>">
								<button type="button" class="btn btn-info">
									<span class="glyphicon glyphicon-plus"></span> 
								</button>
							</a>
						</td>
					</tr>

			<?php } ?>
		  </table>			
		</div><!--acordion-->
	</div><!--row-->
</div>