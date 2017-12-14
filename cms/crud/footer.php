			</div>
		</div>
	</div>
    <br>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&copy 2017 <a href="<?= $git_url ?>"><?= $cms_title ?></a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= DIR_URL ?>assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?= DIR_URL ?>assets/js/popper.min.js"></script>
    <script src="<?= DIR_URL ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= DIR_URL ?>cms/vendors/summernote/summernote-bs4.js"></script>

    <script type="text/javascript">
        
        function readCover(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#readCoverDefault')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(148);
                };

                reader.readAsDataURL(input.files[0]);
            }
        };

        $(document).ready(function() {
           $('#summernote').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null
            });
        });

    <?php if ( isset($article["body"]) ) { ?>


        $(document).ready(function() {
            $('#summernote').summernote('code', '<?= addslashes($article["body"]) ?>');
        });

    <?php } ?>
    
        var postForm = function() {
            var content = $('textarea[name="content"]').html($('#summernote').code());
        }

    </script>

    <script>
      
      
      <?php
        if ( isset($numTag) ) {
            echo "countTag = " . ($numTag-1) . ";";
        } else {
            echo "countTag = 0;";
        }
        if ( isset($numSec) ) {
            echo "countSection = " . ($numSec-1) . ";";
        } else {
            echo "countSection = 0;";
        }
      ?>

      $(document).ready(function() {

        $('#addTag').click(function(event) {

          event.preventDefault();

          if (countTag >= 9) {
            alert("Maximum of nine position entries exceeded");
            return;
          };

          countTag++;

          $('#tag_fields').append(
            '<div id="positionTag'+countTag+'"> \
            Tag: <select class="form-control" name="tag_id'+countTag+'"><?php $tags = getTags(); foreach ( $tags as $tag ) { ?>
            <option value="<?= $tag["tag_id"] ?>"><?= $tag["name"] ?></option><?php } ?></select><input type="button" value="-" \
            onclick="$(\'#positionTag'+countTag+'\').remove(); return false;"> \
            </div>');
        });

        $('#addSection').click(function(event) {

          event.preventDefault();

          if (countSection >= 9) {
            alert("Maximum of nine position entries exceeded");
            return;
          };

          countSection++;

          $('#section_fields').append(
            '<div id="positionSection'+countSection+'"> \
            Section: <select class="form-control" name="section_id'+countSection+'"><?php $sections = getSections(); foreach ( $sections as $section ) { ?>
            <option value="<?= $section["section_id"] ?>"><?= $section["name"] ?></option><?php } ?></select><input type="button" value="-" \
            onclick="$(\'#positionSection'+countSection+'\').remove(); return false;"> \
            </div>');
        });

      });
    </script>

  </body>
</html>