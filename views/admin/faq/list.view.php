<div>
    <h1>FAQ</h1>
    <h2>Questions posées</h2>
    <?php $this->addModal("show_table_questions", $questionsActive); ?>
    <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 3): ?>
        <h2>Questions inactives</h2>
        <?php $this->addModal("show_table_questions", $questionsInactive); ?>
    <?php endif; ?>
</div>
