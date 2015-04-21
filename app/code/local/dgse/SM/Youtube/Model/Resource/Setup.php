<?php

class SM_Youtube_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup
{
    public function getDefaultEntities() {
        return array(
            SM_Blog_Model_Blog::ENTITY => array(
                'entity_model' => 'sm_blog/blog',
                'table' => 'sm_blog/blog',
                'attributes' => array(
                    'title' => array(
                        'type'          => 'varchar',
                        'label'         => 'Title',
                        'input'         => 'text',
                        'required'      => true,
                        'sort_order'    => 10,
                        'position'      => 10,
                        'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'content' => array(
                        'type'          => 'text',
                        'label'         => 'Content',
                        'input'         => 'multiline',
                        'sort_order'    => 20,
                        'multiline_count'    => 2,
                        'validate_rules'     => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
                        'position'           => 20,
                        'required' => true,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'image' => array(
                        'type' => 'varchar',
                        'label' => 'Image',
                        'input' => 'file',
                        'required' => true,
                        'sort_order' => 30,
                        'position' => 30,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'create_at' => array(
                        'type' => 'datetime',
                        'label' => 'Create At',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 40,
                        'position' => 40,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'update_at' => array(
                        'type' => 'datetime',
                        'label' => 'Update At',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 45,
                        'position' => 45,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'url' => array(
                        'type' => 'varchar',
                        'label' => 'Url',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 50,
                        'position' => 50,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'enable' => array(
                        'type' => 'boolean',
                        'label' => 'Enable',
                        'input' => 'select',
                        'required' => false,
                        'sort_order' => 50,
                        'position' => 50,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                )
            )
        );
    }

}