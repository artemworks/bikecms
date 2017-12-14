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

  </body>
</html>