<!DOCTYPE HTML>
<html>
	<head>
		<title>Generar Elemento MVC</title>
		<script>
                    var nuevoCampo
                    fields = 2;
                    function addInput() {
                        nuevoCampo = document.getElementById('campo'+ fields).innerHTML;
                        nuevoCampo += '<div id="campo' + fields + '">' +
                        '<input type="text" name="campo' + fields + '" placeholder="nombre del campo ' + fields + '">\n' +
                        '<input type="text" name="default' + fields + '" size="7px" placeholder="valor default">\n' +
                        '<select name="tipo' + fields + '">' +
                                '<option value="nvarchar" selected>nvarchar</option>' +
                                '<option value="nchar">nchar</option>' +
                                '<option value="varchar">varchar</option>' +
                                '<option value="int">int</option>' +
                                '<option value="float">float</option>' +
                                '<option value="money">money</option>' +
                                '<option value="date">date</option>' +
                                '<option value="datetime">datetime</option>' +
                                '<option value="time">time</option>' +
                                '<option value="char">char</option>' +
                                '<option value="bit">bit</option>' +
                                '<option value="timestamp">timestamp</option>' +
                                '<option value="xml">xml</option>' +
                                '<option value="binary">binary</option>' +
                                '<option value="varbinary">varbinary</option>' +
                                '<option value="image">image</option>' +
                                '<option value="table">table</option>' +
                        '</select>\n' +
                        '<input type="number" name="longitud' + fields + '" size="2px" style="width:50px;" placeholder="tama&ntilde;o">\n' +
                        '<select name="null' + fields + '">' +
                                '<option value="NULL" selected>NULL</option>' +
                                '<option value="NOT NULL" selected>NOT NULL</option>' +
                        '</select>' +
                        '<input type="radio" name="key' + fields + '" value="" checked="checked">Ninguno' +
                        '<input type="radio" name="key' + fields + '" value="key">Key' +
                        '<input type="radio" name="key' + fields + '" value="index">Index' + 
                        '<input type="checkbox" name="ai' + fields + '" value="ai1"> AI' + 
                        '<br />' +
                        '</div>' +
                        '<div id="campo' + (fields + 1) +'">' +
                        '</div>';
                        document.getElementById('campo'+ fields).innerHTML += nuevoCampo;
                        fields += 1;
                    }
		</script>
	</head>
	<body>
		<?php
		echo "fecha";
		echo date("n/j/Y");
		?>
	<div>
		<div id="header">
		<h1>Generar Elemento MVC</h1>
		</div>
		<div>
			<form name="form_mvc" action="generadorMVC.php" method="post">
				<input type="text" name="modelo" placeholder="nombre del modelo"><br />
				<input type="button" onclick="addInput()" name="add" value="Agregar Campo" />
				<div id="campos">
                                    <div id="campo1">
					<input type="text" name="campo1" placeholder="nombre del campo 1">
					<input type="text" name="default1" size="7px" placeholder="valor default">
					<select name="tipo1">
						<option value="nvarchar">nvarchar</option>
						<option value="nchar">nchar</option>
						<option value="varchar">varchar</option>
						<option value="int" selected>int</option>
						<option value="float">float</option>
						<option value="money">money</option>
						<option value="date">date</option>
						<option value="datetime">datetime</option>
						<option value="time">time</option>
						<option value="char">char</option>
						<option value="bit">bit</option>
						<option value="timestamp">timestamp</option>
						<option value="xml">xml</option>
						<option value="binary">binary</option>
						<option value="varbinary">varbinary</option>
						<option value="image">image</option>
						<option value="table">table</option>
					</select>
					<input type="number" name="longitud1" style="width:50px;" placeholder="tama&ntilde;o">
					<select name="null1">
						<option value="NULL" selected>NULL</option>
						<option value="NOT NULL" selected>NOT NULL</option>
					</select>
					<input type="radio" name="key1" value="">Ninguno
					<input type="radio" name="key1" value="key" checked="checked">Key
					<input type="radio" name="key1" value="index">Index
                                        <input type="checkbox" name="ai1" value="ai"> AI
					<br />
                                    </div>
                                    <div id="campo2">
                                    </div>
				</div>
				<input type="submit" value="Generar MVC" />
			</form>
		</div>
	</div>
	</body>
</html>