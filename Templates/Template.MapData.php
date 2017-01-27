<div class="BlockSingleHeadline"><h1 data-view="NewDestination">Map Data</h1></div>

<div class="BlockButtons">
	<panel-button id="ButtonCreateDestination" data-icon="Save"><string>Create Destination</string></panel-button>
</div>


<div class="BlockFullWidth">	
	<table class="Info" >			
		
		<tr>
			<td><strong>Destination</strong></td>
			<td><strong>Routes</strong></td>
			<td><strong>Supplier</strong></td>
			<td><strong>Action</strong></td>
		</tr>

		<?php foreach ( $this -> Data['Destinations'] as $I => $Destination ) { ?>

		<tr>
			<td><?php echo $Destination['DestinationName']; ?></td>
			
			<td>

				<?php echo ($Destination['RouteDirect']==1 ? 'Direct ' : ''); ?>
				<?php echo ($Destination['RouteCharter']==1 ? 'Charter' : ''); ?>
				
			</td>

			<td><?php echo $Destination['Supplier']; ?></td>

			<td><a href="<?php echo CustomURL( 'Panel/map/edit/' . $Destination['DestinationId'] ); ?>">Edit</a></td>
		</tr>

		<?php } ?> 

	</table>

</div>

<!-- <div class="BlockTabsheet">

	<div class="BlockTab">

		<table class="Info" >			
			
			<tr>
				<td><strong>Destination</strong></td>
				<td><strong>Routes</strong></td>
				<td><strong>Supplier</strong></td>
				<td><strong>Action</strong></td>
			</tr>

			<?php foreach ( $this -> Data['Destinations'] as $I => $Destination ) { ?>

			<tr>
				<td><?php echo $Destination['DestinationName']; ?></td>
				
				<td>

					<?php echo ($Destination['RouteDirect']==1 ? 'Direct ' : ''); ?>
					<?php echo ($Destination['RouteCharter']==1 ? 'Charter' : ''); ?>
					
				</td>

				<td><?php echo $Destination['Supplier']; ?></td>

				<td><a href="<?php echo CustomURL( 'Panel/map/edit/' . $Destination['DestinationId'] ); ?>">Edit</a></td>
			</tr>

			<?php } ?> 

		</table>
	</div>
</div> -->



