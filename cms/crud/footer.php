			</div>
		</div>
	</div>
    <br>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&copy <a href="<?= $git_url ?>"><?= $cms_title ?></a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="<?= $dir_url ?>assets/js/bootstrap.min.js"></script>

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
   	</script>

  </body>
</html>