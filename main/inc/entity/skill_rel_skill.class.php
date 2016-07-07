<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @license see /license.txt
 * @author autogenerated
 */
class SkillRelSkill extends \Entity
{
    /**
     * @return \Entity\Repository\SkillRelSkillRepository
     */
     public static function repository(){
        return \Entity\Repository\SkillRelSkillRepository::instance();
    }

    /**
     * @return \Entity\SkillRelSkill
     */
     public static function create(){
        return new self();
    }

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var integer $skill_id
     */
    protected $skill_id;

    /**
     * @var integer $parent_id
     */
    protected $parent_id;

    /**
     * @var integer $relation_type
     */
    protected $relation_type;

    /**
     * @var integer $level
     */
    protected $level;


    /**
     * Get id
     *
     * @return integer 
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Set skill_id
     *
     * @param integer $value
     * @return SkillRelSkill
     */
    public function set_skill_id($value)
    {
        $this->skill_id = $value;
        return $this;
    }

    /**
     * Get skill_id
     *
     * @return integer 
     */
    public function get_skill_id()
    {
        return $this->skill_id;
    }

    /**
     * Set parent_id
     *
     * @param integer $value
     * @return SkillRelSkill
     */
    public function set_parent_id($value)
    {
        $this->parent_id = $value;
        return $this;
    }

    /**
     * Get parent_id
     *
     * @return integer 
     */
    public function get_parent_id()
    {
        return $this->parent_id;
    }

    /**
     * Set relation_type
     *
     * @param integer $value
     * @return SkillRelSkill
     */
    public function set_relation_type($value)
    {
        $this->relation_type = $value;
        return $this;
    }

    /**
     * Get relation_type
     *
     * @return integer 
     */
    public function get_relation_type()
    {
        return $this->relation_type;
    }

    /**
     * Set level
     *
     * @param integer $value
     * @return SkillRelSkill
     */
    public function set_level($value)
    {
        $this->level = $value;
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function get_level()
    {
        return $this->level;
    }
}