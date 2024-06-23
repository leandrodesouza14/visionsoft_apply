<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\helpers\Json;

use app\models\Task;
use app\models\Status;

class TaskController extends Controller
{
    /**
     * This is the main method, which loads the task view.
     * @return void
     */

    public function actionIndex()
    {
        $tasks = Task::find()->all();
        $status = ArrayHelper::map(Status::find()->all(), 'id', 'name');

        return $this->render('dashboard', [
            'status' => $status,
            'model' => new Task()
        ]);
    }

    /**
     * This is the method that responds with a list of all registered tasks.
     * @return array
     */

    public function actionList()
    {
        $tasks = Task::find()->with('status')->all();

        if (!$tasks) {
            return $this->asJson(['tasks' => []]);
        }

        foreach ($tasks as $task) {
            $data[] = [
                'task' => $task,
                'status' => $task->status
            ];
        }
        return $this->asJson(['tasks' => $data]);
    }

    /**
     * This is the method that receives data from the insertion form and registers the new task.
     * @return array
     */

    public function actionCreate()
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;

        $task = new Task();
        $task->attributes = Json::decode($request->getRawBody());
        if (!$task->save()) {
            return $this->asJson(['error' => $task->getErrors()]);
        }

        return $this->asJson(['success' => true, 'message' => 'Tarefa criada com sucesso: ' . $task->title]);
    }

    /**
     * This is the method that receives data from the update form and updates the task data.
     * @return array
     */

    public function actionUpdate()
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode($request->getRawBody());

        $task = Task::findOne($data['id']);

        if (!$task) {
            return $this->asJson(['error' => 'Tarefa não encontrada!']);
        }

        $task->attributes = $data;

        if (!$task->save()) {
            return $this->asJson(['error' => $task->getErrors()]);
        }

        return $this->asJson(['success' => true, 'message' => 'Tarefa editada com sucesso: ' . $task->title]);
    }

    /**
     * This is the method that receives the task id and deletes it.
     * @return array
     */

    public function actionDelete()
    {
        $request = Yii::$app->request;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode($request->getRawBody());

        $task = Task::findOne($data['id']);

        if (!$task->delete()) {
            return $this->asJson(['error' => $task->getErrors()]);
        }

        return $this->asJson(['success' => true, 'message' => 'Tarefa excluida com sucesso: ' . $task->title]);
    }
}
