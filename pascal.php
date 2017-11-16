<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Neil Richter">
        <title>Triangle de Pascal</title>
        <style>
            table { border-collapse: collapse; }
            td { text-align: center; padding: 0px 5px; border: 1px solid black; box-sizing: border-box; }
    </style>
    </head>
    <body>
        <form method="POST" action="pascal.php">
        	<?php $entered = !empty($_POST['depth']) ? $_POST['depth'] : ""; ?>
            <label for="depth">Profondeur : </label><input type="number" id="depth" name="depth" value="<?php echo "$entered";?>" min="1" max="100">
            <input type="Submit" name="submit">
        </form>
        <?php
		if (!empty($_POST['depth']) ) {
			$depth = $_POST['depth'];
			if ($depth > 30) {
                $depth = 30;
            }
            $value[0][0] = 1;
            
            for ($row=1; $row < $depth; $row++) {
                for ($column=0; $column <= $row; $column++) {
                    if (isset($value[$row-1][$column-1]) && isset($value[$row-1][$column])){
                        $value[$row][$column] = $value[$row-1][$column-1]+$value[$row-1][$column];
                    } else {
                        $value[$row][$column] = 1;
                    }
                }
            }
            
            if ( isset( $_POST['submit'] ) ) {
                echo "<h1>Triangle de profondeur ".$depth."</h1>\n";
                echo "		<table>\n";
            }
            for ($row=0; $row < $depth; $row++) {
                echo "			<tr>\n";
                $colspan = floor(($depth*$depth)/($row+1));
                for ($column=0; $column <= $row; $column++) {
                    echo '				<td colspan="'.$colspan.'">';
                    echo $value[$row][$column];
                    echo "</td>\n";
                }
                echo "			</tr>\n";
            }
            echo "		</table>\n";
        }
        ?>
    </body>
</html>