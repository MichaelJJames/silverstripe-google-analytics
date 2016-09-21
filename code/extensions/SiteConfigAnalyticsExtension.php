<?php
class SiteConfigAnalyticsExtension extends DataExtension {
    private static $db = array(
        'TrackingID' => 'Varchar(255)',
        'EnableTracking' => 'Boolean'
    );
    public function updateCMSFields(FieldList $fields) {

        $fields->addFieldToTab('Root.Analytics', TextField::create('TrackingID', 'Tracking Code'));
        $fields->addFieldToTab('Root.Analytics', CheckboxField::create('EnableTracking', 'Enable Tracking'));

    }

    public function Analytics() {

        if($this->owner->EnableTracking) {

            $code = "
                <!-- Google Analytics -->
                <script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                    ga('create', '".$this->owner->TrackingID."', 'auto');
                    ga('send', 'pageview');
                </script>
                <!-- End Google Analytics -->
            ";

            return $code;

        }else{
            return false;
        }

    }

}