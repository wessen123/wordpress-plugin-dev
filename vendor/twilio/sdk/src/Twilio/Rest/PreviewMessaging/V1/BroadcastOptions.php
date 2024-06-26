<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Bulk Messaging and Broadcast
 * Bulk Sending is a public Twilio REST API for 1:Many Message creation up to 100 recipients. Broadcast is a public Twilio REST API for 1:Many Message creation up to 10,000 recipients via file upload.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\PreviewMessaging\V1;

use Twilio\Options;
use Twilio\Values;

abstract class BroadcastOptions
{
    /**
     * @param string $xTwilioRequestKey Idempotency key provided by the client
     * @return CreateBroadcastOptions Options builder
     */
    public static function create(
        
        string $xTwilioRequestKey = Values::NONE

    ): CreateBroadcastOptions
    {
        return new CreateBroadcastOptions(
            $xTwilioRequestKey
        );
    }

}

class CreateBroadcastOptions extends Options
    {
    /**
     * @param string $xTwilioRequestKey Idempotency key provided by the client
     */
    public function __construct(
        
        string $xTwilioRequestKey = Values::NONE

    ) {
        $this->options['xTwilioRequestKey'] = $xTwilioRequestKey;
    }

    /**
     * Idempotency key provided by the client
     *
     * @param string $xTwilioRequestKey Idempotency key provided by the client
     * @return $this Fluent Builder
     */
    public function setXTwilioRequestKey(string $xTwilioRequestKey): self
    {
        $this->options['xTwilioRequestKey'] = $xTwilioRequestKey;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.PreviewMessaging.V1.CreateBroadcastOptions ' . $options . ']';
    }
}

