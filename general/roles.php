<?php
$roles = array(
  '0 Free',
  '1 Baron',
  '2',
  '3',
  '4',
  '5 Royal Plus',
  '6',
  '7',
  '8',
  '9'
);

// Add roles
foreach ($roles as $index => $role) {
  add_role(
    $index,
    __($role),
    array(
      'read' => true,
      'edit_posts' => false,
      'delete_posts' => false,
    )
  );
}

// Add a capability to a role
// $role = get_role( '5 Royal Plus' );
// $role->add_cap( 'edit_others_posts', true );

?>