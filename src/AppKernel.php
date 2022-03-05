<?php

namespace App;

class AppKernel extends Kernel
{
  public function registerBundles(): iterable
  {
    $bundles = [
      new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
    ];
  }
}