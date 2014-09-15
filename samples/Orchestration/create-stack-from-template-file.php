<?php
/**
 * Copyright 2012-2014 Rackspace US, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

//
// Pre-requisites:
// * Prior to running this script, you must setup the following environment variables:
//   * OS_USERNAME: Your OpenStack Cloud Account Username,
//   * NOVA_API_KEY:  Your OpenStack Cloud Account API Key, and
//   * OS_REGION_NAME: The OpenStack Cloud region you want to use
//

require __DIR__ . '/../../vendor/autoload.php';
use OpenCloud\OpenStack;

// 1. Instantiate a Rackspace client.
$client = new OpenStack(Rackspace::US_IDENTITY_ENDPOINT, array(
    'username' => getenv('OS_USERNAME'),
    'apiKey'   => getenv('NOVA_API_KEY')
));

// 2. Obtain an Orchestration service object from the client.
$region = getenv('OS_REGION_NAME');
$orchestrationService = $client->orchestrationService(null, $region);

// 3. Create a stack.
$stack = $orchestrationService->createStack(array(
    'stack_name'   => 'My Drupal Web Site',
    'template'     => file_get_contents(__DIR__ . '/sample_template.yml'),
    'timeout_mins' => 3
));
