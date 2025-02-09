<?php

namespace Core;

interface IMiddleware{
    public function handle($params = null);
}