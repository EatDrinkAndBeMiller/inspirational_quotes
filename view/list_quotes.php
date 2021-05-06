<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Inspirational Quotes</title>

    <!-- Compressed Foundation CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" 
        integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
    <script src="/js/main.js" defer></script>

    <!--my css-->
    <style>
    body {
        background-color: rgb(35, 145, 121);
        }
    .grid-container {
            background-color: rgb(205, 245, 225);
        }
    </style>

  </head>
  <body>
  <div class="grid-container">
    <h1 class="text-center">Inspirational Quotes</h1>

    <form action="." method="get">
        <div class="grid-x grid-padding-x">
        <div class="medium-6 cell">
            <label>Authors</label>
            <select name="authorId" class="form-select" aria-label="Default select example">
                <option value="0">View all Authors</option>
                <?php foreach ($authors as $a) : ?>
                    <option value="<?=$a['id']?>"><?=$a['author']?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="medium-6 cell">
            <label>Categories</label>
            <select name="categoryId" class="form-select" aria-label="Default select example">
                <option value="0">View all Categories</option>
                <?php foreach ($categories as $c) : ?>
                    <option value="<?=$c['id']?>"><?=$c['category']?></option>
                <?php endforeach ?>
            </select>
        </div>
        </div>
        <div class="text-center">
            <button type="submit" value="submit" class="primary button">Submit</button> &nbsp; &nbsp;
            <button type="reset" id="resetAuthorsCategories" class="warning button">Reset</button>
        </div>
    </form>

    <?php if (empty($quotes)) { ?>
        <h4 class="text-center">No matching quotes found.</h4>
    <?php } else { ?>
        <table class="stack table-scroll">
            <thead>
                <tr>
                    <th>Quote</th>
                    <th width="150">Author</th>
                    <th width="150">Category</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quotes as $q) : ?>
                <tr>
                    <td><h6><b>"<?=$q['quote']?>"</b></h6></td>
                    <td><?=$q['author']?></td>
                    <td><i><?=$q['category']?></i></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php } ?>
    <br><br><br>
</div>


    <!-- Compressed JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js" 
        integrity="sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=" crossorigin="anonymous"></script>
  </body>
</html>

