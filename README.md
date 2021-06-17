download load_font.php and place it to the root directory of your project: curl -o load_font.php https://raw.githubusercontent.com/dompdf/utils/master/load_font.php

then open load_font.php with your editor and place the correct path to your autoload.inc.php, eg require_once 'lib/dompdf/autoload.inc.php';

Open the command line, go to the root folder of your project, and run the utility with the name of the font you are registering and the path to the TFF file eg php load_font.php SourceSansPro ./pathToYourFolder/lib/dompdf/SourceSansPro-Regular.ttf ./pathToYourFolder/lib/dompdf/SourceSansPro-Bold.ttf

php load_font.php Garamond 'fonts/Garamond Regular.ttf' 'fonts/Garamond Bold font.ttf'