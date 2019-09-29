<!--start-->
<div class="page-content"
     xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">
        <div style="text-align:center;">
            <h2>Guru Granth Sahib - Raags
                Index</h2>
            <h2><?php echo ucwords(str_replace('-', " ", $author)); ?></h2>

            <p>
                <button class="btn btn-next"><a href="<?php echo site_url('guru-granth-sahib/index/author'); ?>"
                                                class="">Author
                        Index</a></button>
            </p>
        </div>
        <div class="chapter_index">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_title">
                        <span class="col_section_name">Raag</span>
                        <span class="col_page_no">Page No.</span><br
                                class="clearer"/>
                    </div>

                    <?php
                        $i = 1;
                        if ($raags != FALSE)
                        {
                            foreach ($raags->result() as $raag)
                            {
                                echo '
	<a href="' . site_url('guru-granth-sahib/ang/' . $raag->pageno) . '">
	<div class="section_line line row' . $i . '">
	  <span class="col_section_name">' . $raag->raag . '</span>
	  <span class="col_page_no">' . $raag->pageno . '</span>
	</div>
	</a>
			';
                                $i = -$i;
                            }
                        }
                        else
                        {
                            echo '
	<div class="section_line line row' . $i . '">
	  <span class="col_section_name">No raags found</span>
	</div>
	';
                        }
                    ?>
                </div>
                <div style="text-align:center;">
                    <p>
                        <button class="btn btn-next"><a href="<?php echo site_url('guru-granth-sahib/index/author'); ?>"
                           class="">Author
                            Index</a></button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end-->
