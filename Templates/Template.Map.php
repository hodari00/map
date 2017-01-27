<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeAaIvJp_ITKP_HsGb0nBJ2a53lyWo4gA"></script>
<script nx:src="Includes/Scripts/infobox.min.js"></script>

<script nx:src="Includes/Scripts/MapJS.min.js"></script>

<script nx:src="Includes/Scripts/maplabel.min.js"></script>

<header class="ContainerLarge TopHeader StickyTopHeader">
	<div class="ContainerSmall">
		
		<div class="TopHeaderLeft ChooseLanguage"> 
			
			<span class="Icon Flag <?php echo $this -> Data['SelectedFlag'] ?>" ></span> 
			<span class="Text"><?php echo $this -> Data['SelectedLanguage'] ?></span> 
			<span class="Icon DownArrow"></span> 

			<div class="LanguagePicker">
				<ul>
					<a nx:href="/?SetLanguage=DA">
						<li>
							<span class="Icon DAFlag"></span> 
							<span class="Text">DK</span> 
						</li>
					</a>
					<a nx:href="/?SetLanguage=EN">
						<li>
							<span class="Icon ENFlag"></span> 
							<span class="Text">EN</span>  
						</li>
					</a>
				</ul>
			</div>
		</div>
		
		<div class="TopHeaderLeft" id="ArrivalsDepartures">
				<span class="Text"><a data-mcms-id="Scope:TopHeaderLeft:ArrivalsDepartures" nx:href="/afgange-ankomster">AFGANGE / ANKOMSTER</a></span>
			</div>

			<div class="TopHeaderLeft" id="Destinations">
				<span class="Text"><a data-mcms-id="Scope:TopHeaderLeft:Destinations" nx:href="/map">DESTINATIONER</a></span>
			</div>

		<div class="ClearFloat"></div>
	</div>
</header>

<nav class="ContainerLarge StickyHeader" id="TopNav">
	
	<div class="ContainerSmall Navigation">
		<?php include RootPath('Application/Views/Templates/CommonElements/Template.Navigation.php'); ?>

		<div class="ClearFloat"></div>
	</div>
</nav>

<div class="HeaderShadow"></div>

<div class="Filters MapPage">
	<div class="Buttons Mobile">
		<div class="Checkboxes">
			<input data-filter="Seasons" data-filter-type="Summer" type="checkbox" checked="checked" id="MobileFilterSummer" value="Summer">
			<label for="MobileFilterSummer"><span></span><string data-mcms-id="Scope:Seasons:FilterSummer:Summer" >Sommer</string></label>

			<input data-filter="Seasons" data-filter-type="Winter" type="checkbox" checked="checked" id="MobileFilterWinter" value="Winter">
			<label for="MobileFilterWinter"><span></span><string data-mcms-id="Scope:Seasons:FilterSummer:Vinter" >Vinter</string></label>

			<div class="ClearFloat"></div>
		</div>
	</div>
	<div class="CaptionWrapper">
				<div class="CaptionHeader">
					<div class="FullHeaderImage">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="30" viewBox="0 0 32 30">
						  <image id="Vector_Smart_Object" data-name="Vector Smart Object" width="32" height="30" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAeCAMAAAB61OwbAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABd1BMVEUAAAAgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQgPmQAAACXhDDhAAAAe3RSTlMAG2+y3/uQEIaOCi2u/RLb3UECVJkFh/wYsQ4JaO8Pws9CYPDk6t7SsCMTO/f6niEDu41WC4j0kiAzpxl4c1AfoOwe9iio/umX1Qcw+Jgk1OI0Y1yU2AQGU9FGW7VS5WUB8znjGiXouHQd3BdqzC56zgjtPLwcr7c2diIKLiU+AAAAAWJLR0QAiAUdSAAAAAlwSFlzAAALEgAACxIB0t1+/AAAAY1JREFUKM9tU2dDwkAMPRwUhaIoilJx4EIRJ04cIIq4EdwTJ4p7j/x5c9cebWnfhzaXvLvkXnKEcFhKSsvKrdQSbBWVpBh2hwgISnBWAVS7qLOm1u2Sw3X1HgBOIA2NaLm9UhMyfSze3MKirW0WSd7gbwfo6KS+LhbvRgtdAbro6aXfYB/bEuofwMXgEJrDI4wQHg2NjU9MTrGMPluEnTeN9gyZZYS5KIZEuZ6YU843H2e1zSopFhYTGPQs0U0ykgDLKyqBkNXA2vrGJqSUgr1x0IBdk0hkCyCtHJABI4GQbdjZVcyoGWEvBvtc4wOAQwFxBHAsCErek9OzLCecA3jpXy0ScSGpXUK5iIGghYFgBfAz4xLgyiwFJ2SxHWG5yKAp4RrgxnhNPXJGofS4NUqtQ+KONyt/z4VC4PpBEJyPAA7TditF4pCIT4oS2oHhhIymcbqRkwnpZ/S8vBbE1A0tJbzhOh/RyK2OvRB5/5DtT11DCg+HXzApkSLYv0Q1/v1j1lb2eMGTyv3+ad3/XTfGnJgqd00AAAAASUVORK5CYII="/>
						</svg>					
					</div>
					<span data-mcms-id="Scope:FullHeaderImage:Destinationer">Destinationer</span>				
				</div>

			</div>
	<div class="Buttons ContainerSmall">
		<button data-mcms-id="Scope:Routes:All" class="Active" data-filter="Routes" data-filter-type="All" onclick="$('button').removeClass('Active');$(this).addClass('Active');">Alle</button>
		<button data-mcms-id="Scope:Routes:Charter" data-filter="Routes" data-filter-type="Charter" onclick="$('button').removeClass('Active');$(this).addClass('Active');">Charter</button>
		<button data-mcms-id="Scope:Routes:Direct" data-filter="Routes" data-filter-type="Direct" onclick="$('button').removeClass('Active');$(this).addClass('Active');">Ruter</button>

		<div class="Checkboxes">
			<input data-filter="Seasons" data-filter-type="Summer" type="checkbox" checked="checked" id="FilterSummer" value="Summer">
			<label for="FilterSummer"><span></span><string data-mcms-id="Scope:Seasons:FilterSummer:Summer" >Sommer</string></label>

			<input data-filter="Seasons" data-filter-type="Winter" type="checkbox" checked="checked" id="FilterWinter" value="Winter">
			<label for="FilterWinter"><span></span><string data-mcms-id="Scope:Seasons:FilterSummer:Vinter" >Vinter</string></label>

			<div class="ClearFloat"></div>
		</div>
	</div>
</div>

<header id="MobileNav">
	<div class="MobileNavBtn" id="NavSearchIcon">
		<a href="#"><img nx:src="Includes/Images/mag-glass.png"></a>
	</div>
	<div class="MobileNavBtn">
		<div class="bar1"></div>
	  	<div class="bar2"></div>
	  	<div class="bar3"></div>
	</div>
	<div class="MobileNavLogo"></div>
	<div class="MobileNavLanguagePicker"></div>
	<div class="MobileNavLinks"></div>
</header>

<section class="ContainerLarge">

	<div class="MapContainer">
		<div id="Map"></div>
	</div>

</section>