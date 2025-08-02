#!/bin/bash

cd resources/views || exit

# 1. Delete unwanted top-level folders/files except the ones to keep
for item in *; do
  if [[ ! " admin auth cart errors layouts pages partials products vendor " =~ " $item " ]]; then
    echo "Deleting $item"
    rm -rf "$item"
  fi
done

# 2. Ensure required directories exist
mkdir -p admin auth cart errors layouts pages partials products/vendor/pagination

# 3. Create empty placeholder blade files if missing

touch admin/categories.blade.php
touch admin/dashboard.blade.php
touch admin/messages.blade.php
touch admin/products.blade.php

touch auth/login.blade.php
touch auth/register.blade.php

touch cart/index.blade.php

touch errors/404.blade.php
touch errors/500.blade.php

touch layouts/app.blade.php

touch pages/contact.blade.php
touch pages/home.blade.php
touch pages/product_detail.blade.php
touch pages/show.blade.php
touch pages/welcome.blade.php

touch partials/footer.blade.php
touch partials/navbar.blade.php

touch products/index.blade.php
mkdir -p products/partials
touch products/partials/preview-modal.blade.php
touch products/partials/product-card.blade.php
touch products/partials/product-card-list.blade.php

touch vendor/pagination/bootstrap-4.blade.php
touch vendor/pagination/bootstrap-5.blade.php
touch vendor/pagination/default.blade.php
touch vendor/pagination/semantic-ui.blade.php
touch vendor/pagination/simple-bootstrap-4.blade.php
touch vendor/pagination/simple-bootstrap-5.blade.php
touch vendor/pagination/simple-default.blade.php
touch vendor/pagination/simple-tailwind.blade.php
touch vendor/pagination/tailwind.blade.php

echo "Clean-up and setup complete."
