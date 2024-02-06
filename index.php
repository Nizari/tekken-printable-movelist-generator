<?php

use Smarty\Smarty;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/views');
$smarty->setCompileDir(__DIR__ . '/tmp/compiled/');
$smarty->setCacheDir(__DIR__ . '/tmp/cache/');
$smarty->setConfigDir(__DIR__ . '/tmp/config/');


// Notation	Action
// 1	Left Punch (Square / X)
// 2	Right Punch (Triangle / Y)
// 3	Left Kick (Cross / A)
// 4	Right Kick (Circle / B)
// N	Neutral (Pressing nothing)
// f	Forward
// b	Back
// u	Up
// d	Down
// d/f, d/b, u/f, u/b	Down Forward, Down Back, Up Forward, Up Back
// qcf / qcb	Quarter Circle Forward / Quarter Circle Back
// SS / SSR / SSL	Sidestep / Sidestep Right / Sidestep Left
// FC	Fully Crouched
// WS	While Standing / While Rising
// WR	While Running
// ()	Rapidly press one after the other
// @link https://gamerant.com/tekken-8-victor-character-guide-move-list-combos-tips-how-play/
// @link https://www.youtube.com/watch?v=McLA8JnwTGU
$sections = [
    [
        "name" => "Perfumer Stance",
        "moves" => [
            ['name' => 'Perfumer', 'combo' => ['f',3], 'note' => ['Perform ', 'd/f', ' to shift to crouched']],
            ['name' => 'Cutlery Etiquette', 'combo' => [2,1,'fp'], 'note' => ['blink forward and shift to Iai Stance']],
            ['name' => 'Emerald Cut', 'combo' => ['db',1,1,'fp']],
            ['name' => 'Vanity Love', 'combo' => ['b',1,2], 'note' => ['Shift to throw on front hit', 'b', 1, 'fp', ' to shift to Perfumer']],
            ['name' => 'Pearly Gates', 'combo' => ['WS',"1+2", "fp"]],
        ]
    ],
    [
        "name" => "Iai Stance",
        "moves" => [
            ['name' => 'Iai Stance', 'combo' => ['3+4']],
            ['name' => 'Crybaby Sophia', 'combo' => [2,2,2], 'note' => ['Chip damage']],
            ['name' => 'Selfish Miranda', 'combo' => ['df',4,2], 'note' => ['Chip damage']],
            ['name' => 'Gringolet', 'combo' => ['uf',1,1], 'note' => ['uf',1,1,'3+4', ' to cancel into Lai Stance']],
            ['name' => 'Amour Shaft', 'combo' => ['d','df','f',2]],
        ]
    ],
];
$console = 'PS4';
// foreach moves->combo and notes, replace the notation with images
foreach ($sections as $sectionKey => $section) {
    foreach ($section['moves'] as $moveKey => $move) {
        $combo = $move['combo'];
        $note = $move['note'] ?? [];
        $parseMove = function($command) use ($console) {
            $getcwd = getcwd();
            if ($command === 'WS') {
                return 'While Standing';
            } elseif (file_exists($getcwd . '/assets/button/' . $console . '/' . $command . '.svg')) {
                return "<img class='move-button' src='{$getcwd}/assets/button/{$console}/{$command}.svg'>";
            } elseif (file_exists($getcwd . '/assets/arrow/' . $command . '.svg')) {
                return "<img class='move-arrow' src='{$getcwd}/assets/arrow/{$command}.svg'>";
            } else {
                return $command;
            }
        };

        $combo = array_map($parseMove, $combo);
        $note = array_map($parseMove, $note);
        $sections[$sectionKey]['moves'][$moveKey]['combo'] = implode(' ', $combo);
        $sections[$sectionKey]['moves'][$moveKey]['note'] = implode(' ', $note);
    }
}

$smarty->assign([
    'console' => 'PS4',
    'sections' => $sections,
    'base_url' => getcwd(),
]);
$htmlContent = $smarty->fetch('pdf.tpl');
file_put_contents(__DIR__.'/tmp/tekken_moves.html', $htmlContent);

dump("Open below link in your browser and print");
dd(__DIR__.'/tmp/tekken_moves.html');


// @TODO mPDF cant handle SVG
// // Initialize mPDF
// $mpdf = new \Mpdf\Mpdf();

// // Write the HTML content to the PDF
// $mpdf->WriteHTML($htmlContent);
// // dont show header and footer info
// $mpdf->SetHTMLHeader('');
// $mpdf->SetHTMLFooter('');
// // Output the PDF to getcwd().'/tmp/tekken_moves.pdf'
// $mpdf->Output(__DIR__.'/tmp/tekken_moves.pdf', \Mpdf\Output\Destination::FILE);