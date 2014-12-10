<?php
namespace Dossier\Entities;
/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 9/22/14
 * Time: 2:05 PM
 */

/**
 * @Entity @Table(name="speaker_bios")
 **/
class SpeakerBio
{
    protected $id;

    protected $speaker;


    protected $content;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
} 