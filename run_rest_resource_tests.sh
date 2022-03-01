ls --color=never -d tests/Rest/Admin* | \
  xargs -I {} sh -c "echo && echo \"Running tests under \"{}\"\" && ./vendor/bin/phpunit --color \"{}\" || exit 255"