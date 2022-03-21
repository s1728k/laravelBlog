<!DOCTYPE html>
<html>
<head>
	<title>welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
    @powerGridStyles
    <style>
        #input_text_options{
            display:none;
        }
    </style>
</head>
<body>
	@livewire('country-table', ['region'=>'Africa'])
    {{-- <livewire:country-table region="Africa"/> --}}
    {{-- @livewire('livewire-ui-modal') --}}

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	@livewireScripts
    @powerGridScripts
     @livewire('livewire-bs4-ui-modal')
</body>
</html>