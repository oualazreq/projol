<?php session_start();?>
<?php include 'header.php'; ?>
<body>

    <!-- Script DATE  -->
	<script>
	var initDatepicker = function() {  
    $('input[type=date]').each(function() {  
        var $input = $(this);  
        $input.datepicker({  
            minDate: $input.attr('min'),  
            maxDate: $input.attr('max'),  
            dateFormat: 'yyyy-mm-dd'  
        });  
    });  
};  
  
if(!Modernizr.inputtypes.date){  
    $(document).ready(initDatepicker);  
};  
  </script>

<!-- -->
<script type="text/javascript">

            <!--
function show_retour(a){
        if(a==1){
            $('#dateretour').css("display","block");
            $('#volarrive').css("display","block");
            $('#divvolbox1').css('border','rgb(226,9,124) 1px solid');
            $('#divvolbox0').css('border','none');
           
            }

            //m_ctrlFlightSearchMini_m_rbtRoundTrip
        else{
            $('#dateretour').css("display","none");
            $('#volarrive').css("display","none");
            $('#divvolbox0').css('border','rgb(226,9,124) 1px solid');
            $('#divvolbox1').css('border','none');
           
            
        }
     }
            jQuery(function(){

                $("#m_ctrlFlightSearchMini_m_rbtRoundTrip").click(function(){
                    show_retour(1);
                })
                $("#divvolbox1").click(function(){
                    show_retour(1);
                })
                
                 $("#m_ctrlFlightSearchMini_m_rbtSingleTrip").click(function(){
                    show_retour(0);
                })
                $("#divvolbox0").click(function(){
                    show_retour(0);
                })
                
               
            });
            //-->
        </script>
<!-- -->
<div class="container">
	<div style="display:inline-block; padding-left:150px; padding-top:100px; margin-left:100px">
		<h2>Réservez votre billet dès maintenant!</h2>
		<form  style="padding-left:100px;"   action="flight_result.php" method="Post" >
			<fieldset>
				<div id="volallerretour" style="padding-bottom: 20px;">
			    <label for="allerretour" class="volbox volbox12">
		            <input id="m_ctrlFlightSearchMini_m_rbtRoundTrip" type="radio" name="m_ctrlFlightSearchMini$rbtTrip" value="aller_retour" checked="true">
		            <span id="divvolbox1" class="divvolbox">aller / retour</span></label>         
		         <label for="allersimple" class="volbox volbox12">       
		            <input id="m_ctrlFlightSearchMini_m_rbtSingleTrip" type="radio" name="m_ctrlFlightSearchMini$rbtTrip" value="aller_simple">
		            <span id="divvolbox0" class="divvolbox">aller simple</span></label>
		        </div>
				<p>
					<label for="text">Classe</label>
					<select name="classe" id="classe">
		                <option value="Eco">Eco</option>
		                <option value="Business">Business</option>  
		            </select>
		         </p>
				<div id ="voldepart"  >
					<div id="villedepart">
						<label for="texte">Origine</label> 
						<select name="villedep" id="villedep">
			               	<option value="Oujda">Oujda</option>
			               	<option value="Brussels">Brussels</option>
			               	<option value="Cairo">Cairo</option>
			               	<option value="Casablanca">Casablanca</option>
			               	<option value="Istanbul">Istanbul</option>
			               	<option value="Paris">Paris</option>
			               	<option value="Tunis">Tunis</option>
			       		</select>    	
			        </div>
			       	<div id="villearr">
			        	<label for="texte">Destination</label>
						<select name="villearr" id="villearr">
			               	<option value="Oujda">Oujda</option>
			               	<option value="Brussels">Brussels</option>
			               	<option value="Cairo">Cairo</option>
			               	<option value="Casablanca">Casablanca</option>
			               	<option value="Istanbul">Istanbul</option>
			               	<option value="Paris">Paris</option>
			               	<option value="Tunis">Tunis</option>
			       		</select>
			        	
			        </div>	
					<div id="datedepart"> 
						<label for="texte">Date Aller</label>
						<input type="date" name="datedep" id="m_ctrlFlightSearchMini$m_txtDateDep" value="" />
					</div>
				</div>
					<div id="volarrive" >
						<div id="dateretour">
							<label for="texte">Date Retour</label>
							<input type="date" name="dateret" id="m_ctrlFlightSearchMini$m_txtDateRet" value=""/>
						</div>
					</div>
					
					<p>
					<label for="numeric">Adultes</label>
						<select name="nbreadultes" id="nbreadultes">
			                <option value="1">1</option>
			                <option value="2">2</option>
			                <option value="3">3</option>
			                <option value="4">4</option>
			        	</select>
					</p>
					<p>
						<label for="numeric">Enfants</label>
						<select name="nbreenfants" id="nbreenfants">
							<option value="0">0</option>
			                <option value="1">1</option>
			                <option value="2">2</option>
			                <option value="3">3</option>
			                <option value="4">4</option>
			             </select>
					</p>
					<div class="sub" ><input type="submit" role="button" aria-disabled="false" value="Chercher" name="search" ></div> 
					<div class="clear"></div>
			</fieldset>
		</form>
	</div>
<!-- banner right -->	
<?php include 'banner_right.php'; ?>
</div>



<!-- footer -->	
<?php include 'footer.php'; ?>