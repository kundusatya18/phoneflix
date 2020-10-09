@extends('admin.app')
@push('styles')
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap-tagsinput.css') }}" /> -->
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/amsify.suggestags.css') }}">
	<style>
	/*the container must be positioned relative:*/
	.autocomplete {
	  position: relative;
	  display: inline-block;
	}

	input {
	  border: 1px solid transparent;
	  background-color: #f1f1f1;
	  padding: 10px;
	  font-size: 16px;
	}

	input[type=text] {
	  background-color: #f1f1f1;
	  width: 100%;
	}

	input[type=submit] {
	  background-color: DodgerBlue;
	  color: #fff;
	  cursor: pointer;
	}

	.autocomplete-items {
	  position: absolute;
	  border: 1px solid #d4d4d4;
	  border-bottom: none;
	  border-top: none;
	  z-index: 99;
	  /*position the autocomplete items to be the same width as the container:*/
	  top: 100%;
	  left: 0;
	  right: 0;
	}

	.autocomplete-items div {
	  padding: 10px;
	  cursor: pointer;
	  background-color: #fff; 
	  border-bottom: 1px solid #d4d4d4; 
	}

	/*when hovering an item:*/
	.autocomplete-items div:hover {
	  background-color: #e9e9e9; 
	}

	/*when navigating through the items using the arrow keys:*/
	.autocomplete-active {
	  background-color: DodgerBlue !important; 
	  color: #ffffff; 
	}
	</style>
@endpush
@section('title') {{ $pageTitle }} @endsection
@section('content')
	<div class="fixed-row">
		<div class="app-title">
			<div class="active-wrap">
				<h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
				<div class="form-group">
		  <button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-check-circle"></i>Update Country</button>
					<a class="btn btn-secondary" href="{{ route('admin.country.index') }}"><i style="vertical-align: baseline;" class="fa fa-chevron-left"></i>Back</a>
				</div>
			</div>
		</div>
	</div>
	@include('admin.partials.flash')
	<div class="alert alert-success" id="success-msg" style="display: none;">
		<span id="success-text"></span>
	</div>
	<div class="alert alert-danger" id="error-msg" style="display: none;">
		<span id="error-text"></span>
	</div>
	<div class="row section-mg row-md-body no-nav">
		<div class="col-md-12 mx-auto">
			<div class="tile">
				<form action="{{ route('admin.country.update') }}" method="POST" role="form" id="form1" enctype="multipart/form-data">
					@csrf
					<div class="tile-body form-body">
						<div class="form-group">
							<label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
							<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $targetCountry->name) }}" readonly="readonly" />
							<input type="hidden" name="id" value="{{ $targetCountry->id }}">
							@error('name') {{ $message }} @enderror
						</div>
						<div class="form-group">
							<label class="control-label" for="title">City <span class="m-l-5 text-danger"> *</span></label>
							<input type="text" id="tags" class="form-control" name="cities" value="{{$cities}}">
							 @error('cities') {{ $message }} @enderror
						</div>
						<div class="form-group toogle-lg">
							<label class="control-label">Status</label>
							<div class="toggle-button-cover">
								<div class="button-cover">
									<div class="button-togglr b2" id="button-11">
										<input id="toggle-block" type="checkbox" data-country_id="{{$targetCountry->id}}" name="status" class="checkbox" {{ $targetCountry->status == 1 ? 'checked' : '' }}>
										<div class="knobs"><span>Inactive</span></div>
										<div class="layer"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="tile-footer">
						<button class="btn btn-primary" type="button" id="btnSave"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Country</button>
						&nbsp;&nbsp;&nbsp;
						<a class="btn btn-secondary" href="{{ route('admin.country.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.amsify.suggestags.js') }}"></script>
	<script type="text/javascript">

		var countries = [];
		var all_cities = [];
		var cities = [];
		var country_cca2 = '{{$targetCountry->code}}';

		$(document).ready(function(){
		  
			var getCityByCountryUrl = '{{url("admin/country/getcitiesbycountry")}}';
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				type:'POST',
				dataType:'JSON',
				url:getCityByCountryUrl,
				data:{ _token: CSRF_TOKEN, cca2: country_cca2 },
				success:function(response)
				{
				  for (var key in response)
					cities.push(response[key].name);
				  console.log(response)
					$('#tags').amsifySuggestags({
					  type : 'amsify',
					  suggestions: cities,
					  whiteList: true
				  });
				},
				error: function(response)
				{
				  console.log(response);
				}
			  });

			$.ajax({
			  type:'GET',
			  dataType:'JSON',
			  url:"https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-abbreviation.json",
			  data:"",
			  success:function(response)
			  {
				  //console.log("country>>"+JSON.stringify(response));
				  countries = response;
				  autocomplete(document.getElementById("name"), countries);
			  },
			  error: function()
			  {
				console.log("error in fetching country list");
			  }
			});



			$("#btnSave").on("click",function(){
				// /$("#tags").val();
				console.log("tags>>"+$("#tags").val());
				if($("#tags").val()!=''){
					$('#form1').submit();
				}  
			})
			
		})
	</script>
	<script>
		function autocomplete(inp, arr) {
		  /*the autocomplete function takes two arguments,
		  the text field element and an array of possible autocompleted values:*/
		  var currentFocus;
		  var cname='';
		  /*execute a function when someone writes in the text field:*/
		  inp.addEventListener("input", function(e) {
			  var a, b, i, val = this.value;
			  /*close any already open lists of autocompleted values*/
			  closeAllLists();
			  if (!val) { return false;}
			  currentFocus = -1;
			  /*create a DIV element that will contain the items (values):*/
			  a = document.createElement("DIV");
			  a.setAttribute("id", this.id + "autocomplete-list");
			  a.setAttribute("class", "autocomplete-items");
			  /*append the DIV element as a child of the autocomplete container:*/
			  this.parentNode.appendChild(a);
			  /*for each item in the array...*/
			  for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].country.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
				  /*create a DIV element for each matching element:*/
				  b = document.createElement("DIV");
				  /*make the matching letters bold:*/
				  b.innerHTML = "<strong>" + arr[i].country.substr(0, val.length) + "</strong>";
				  b.innerHTML += arr[i].country.substr(val.length);
				  /*insert a input field that will hold the current array item's value:*/
				  b.innerHTML += "<input type='hidden' value='" + arr[i].country + "'>";
				  b.innerHTML += "<input type='hidden' value='" + arr[i].abbreviation + "'>";
				  /*execute a function when someone clicks on the item value (DIV element):*/
				  b.addEventListener("click", function(e) {
					cities = [];
					//alert(this.getElementsByTagName("input")[1].value);
					  /*insert the value for the autocomplete text field:*/
					  inp.value = this.getElementsByTagName("input")[0].value;
					  $('#code').val(this.getElementsByTagName("input")[1].value);
					  cname = this.getElementsByTagName("input")[1].value;

					  for(var x=0;x<all_cities.length;x++){
						if(all_cities[x].country==cname){
							cities.push(all_cities[x].name);
						}
					  }
					  console.log("cities>>"+cities);
					  $('#tags').amsifySuggestags({
						suggestions: cities
					});
					  /*close the list of autocompleted values,
					  (or any other open lists of autocompleted values:*/
					  closeAllLists();
				  });
				  a.appendChild(b);
				}
			  }
		  });
		  /*execute a function presses a key on the keyboard:*/
		  inp.addEventListener("keydown", function(e) {
			  var x = document.getElementById(this.id + "autocomplete-list");
			  if (x) x = x.getElementsByTagName("div");
			  if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			  } else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			  } else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1) {
				  /*and simulate a click on the "active" item:*/
				  if (x) x[currentFocus].click();
				}
			  }
		  });
		  function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false;
			/*start by removing the "active" class on all items:*/
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add("autocomplete-active");
		  }
		  function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
			  x[i].classList.remove("autocomplete-active");
			}
		  }
		  function closeAllLists(elmnt) {
			/*close all autocomplete lists in the document,
			except the one passed as an argument:*/
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
			  if (elmnt != x[i] && elmnt != inp) {
				x[i].parentNode.removeChild(x[i]);
			  }
			}
		  }
		  /*execute a function when someone clicks in the document:*/
		  document.addEventListener("click", function (e) {
			  closeAllLists(e.target);
		  });
		}
</script>
@endpush