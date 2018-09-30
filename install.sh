#!/bin/bash

if [[ "$(docker images -q tiki-home-test-img 2> /dev/null)" == "" ]]; then
    docker build -t tiki-home-test-img .
fi

docker run -it --rm --name tiki-home-test-container -p 80:80 -v "$PWD":/www/data/tiki-home-test tiki-home-test-img