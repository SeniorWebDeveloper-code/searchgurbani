<?php
global $SG_SearchTypes, $SG_ScriptureTypes, $SG_SearchLanguage, $SG_Preferences;
?>
<link href="<?= base_url() ?>Mobile/css/default.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url() ?>Mobile/css/iphone.css" rel="stylesheet" type="text/css"/>
<style>
    .content_inner {
        margin: 0 auto;
        padding: 0 10px 0 0;
        width: 100%;
    }
</style>
<div id="wrapper">
    <div class="content">
        <h1>Sri Guru Granth Sahib<span class="right"><a href="<?= base_url() ?>scriptures/" style="margin-right:10px;">Home</a><?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
                    <a href="<?= $_SERVER['HTTP_REFERER'] ?>">back</a><?php } ?></span></h1>
        <div class="content_inner">

            <?

            $atts = array(
                'width' => '95%',
                'height' => '95%',
                'scrollbars' => 'yes',
                'status' => 'yes',
                'resizable' => 'yes',
                'screenx' => '0',
                'screeny' => '0'
            );

            $utilityBar = '
<div class="utility_bar">
	<span class="col_float_right">
		
	</span>
	<br class="clearer" />
</div>
';
            ?>
            <script src="<?php echo base_url(); ?>scripts/jquery.dimensions.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>scripts/jquery.tooltip.min.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function () {
                    $('.tt').tooltip({
                        track: true,
                        delay: 0,
                        showURL: false,
                        showBody: " - ",
                        fade: 0
                    });
                });

            </script>


            <div style="background-color:#fceaaa" align="center">
                <h2><?php echo $shabad_info->shabad_name . '<br />' . $shabad_info->shabad_punjabi; ?></h2>
                <p>
                    <?php echo "
  	<strong>This shabad is by " . $shabad_info->author . " in " . $shabad_info->raag . " on Page " . $shabad_info->pageno . "<br />
	in Section '" . $shabad_info->section_name . "' of Amrit Keertan Gutka.</strong>
  ";
                    ?>
                </p>
            </div>

            <?php
            echo $utilityBar;

            $printable_languages = get_printable_languages('ak');

            if ($lines === false) {
                echo '
	<div class="line row1">
	  <p class="english">No lines found</p>
	</div>
	';
            } else {
                $alt_row = 1;

                if ($SG_Preferences['text_type'] == 'line_by_line') {
                    /** Line by Line **/
                    foreach ($lines->result() as $line) {
                        $highlight = ($highlight_line == $line->pagelineno ? ' hl2' : '');
                        $attributes = '<p class="line_info">' . $line->shabadlineno . ' ' . $line->lattrib . ' <br> ' . $line->raag . ' ' . $line->author . ' 
			  <a href="' . site_url('scriptures/page/' . $line->pageno) . '">Page:' . $line->pageno . ' Line: ' . $line->pagelineno . '</a>  
			  </p>';

                        $sharing_data = '<span class="share_icons">';
                        $share_data['text'] = $line->punjabi . ' - ' . $line->translit;
                        $share_data['link'] = site_url('shared/amrit-keertan-shabad/' . $shabad_info->shabad_id . '/shabad/line/' . $line->pagelineno);
                        $sharing_data .= $this->load->view('templates/share_this', $share_data, true);
                        $sharing_data .= '</span>';

                        echo '<div class="line row' . $alt_row . $highlight . '">';
                        foreach ($printable_languages as $printable_language) {
                            echo print_line($printable_language, $line, $keywords);//$keywords
                        }
                        echo get_data_by_preferences($attributes, 'show_attributes');
                        echo get_data_by_preferences($sharing_data, 'allow_share_lines');

                        echo '<br class="clearer" /></div>';
                        $alt_row = -$alt_row;
                    }

                } else {
                    /** Page by Page **/
                    foreach ($lines->result() as $line) {
                        $i = 0;
                        $highlight = ($highlight_line == $line->pagelineno ? ' hl2' : '');
                        foreach ($printable_languages as $printable_language) {
                            $printable_languages[$i]['data'] .= print_line($printable_language, $line, $keywords, $highlight);//$keywords
                            $i++;
                        }
                        $alt_row = -$alt_row;
                    }

                    foreach ($printable_languages as $printable_language) {
                        echo '<p><strong>In ' . $printable_language['lang_name'] . '</strong></p>';
                        echo '<div class="line row' . $alt_row . '">';
                        echo $printable_language['data'];
                        echo '</div>';
                        $alt_row = -$alt_row;
                    }
                }

            }

            echo $utilityBar;
            ?>
            <script type="text/javascript">

                $('.save_as_pdf').click(function () {
                    var url = 'http://savepageaspdf.pdfonline.com/pdfonline/pdfonline.asp?cURL=<?php echo current_url(); ?>&author_id=4BBE928B-5648-4890-BDA9-E8793072D7B4&pageOrientation=0&topMargin=0.5&bottomMargin=0.5&leftMargin=0.5&rightMargin=0.5';
                    window.open(url, '_blank', 'width=600,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');
                    return false;
                });

            </script>
        </div>
    </div>
</div>