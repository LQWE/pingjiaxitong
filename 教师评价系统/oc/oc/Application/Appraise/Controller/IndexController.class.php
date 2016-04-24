<?php
namespace Appraise\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
		$teacherIds=M("userRole")->where(array('status'=>1,'role_id'=>3))->getField('uid',true);
		$teachers=M("member")->where(array('uid'=>array('in',$teacherIds)))->select();
		//var_dump($teachers);
		$this->assign('teachers',$teachers);
        $this->display();
    }
    //uid 教师的uid
    public function selectLesson($uid=0)
    {
        //参数检查
        $uid = intval($uid);
        if(!$uid)
        {
            $this->error("参数错误！");
        }
        //权限检查
        //判断是否登录
        $loginUid=is_login();//取得当前已登录用户的uid
        if(!$loginUid)
        {
            $this->error("您尚未登录！",U("/ucenter/member/login"));
        }
        //判断是否是学生
        if(!(M("userRole")->where(array('status'=>1,'role_id'=>2,'uid'=>$loginUid))->find()))
        {
            $this->error("只有学生才可以评价！");
        }
        //判断该学生是否有修该老师的课程
        //取得该老师的所有课程ID
        $teacherLessonIds=M('appraiseTeacherLesson')
        ->where(array('uid'=>$uid))
        ->getField('lessonId',true);
        //取得该学生选修该老师的所有课程的ID
        $studentLessonIds=M('appraiseStudentLesson')
        ->where(array('uid'=>$loginUid,'lessonId'=>array('in',$teacherLessonIds)))
        ->getField('lessonId',true);
        if(!$studentLessonIds)
        {
            $this->error("您未选修该老师的课程，无法评价");
        }
        $lessons=M('appraiseLesson')
        ->where(array('id'=>array('in',$studentLessonIds)))
        ->select();
        $this->assign('uid',$uid);
        $this->assign("lessons",$lessons);
        $this->display();
    }
    //uid 教师的uid
	public function selectSession($uid=0,$lessonId=0)
	{
	    //参数检查
	    $uid = intval($uid);
	    $lessonId = intval($lessonId);
	    if(!$uid||!$lessonId)
	    {
	        $this->error("参数错误！");
	    }
	    //权限检查
	    //判断是否登录
	    $loginUid=is_login();//取得当前已登录用户的uid
	    if(!$loginUid)
	    {
	        $this->error("您尚未登录！",U("/ucenter/member/login"));
	    }
	    //判断是否是学生
	    if(!(M("userRole")->where(array('status'=>1,'role_id'=>2,'uid'=>$loginUid))->find()))
	    {
	        $this->error("只有学生才可以评价！");
	    }
	    //判断该学生是否有修该课程
	    if(!M('appraiseTeacherLesson')
	    ->where(array('uid'=>$uid,'lessonId'=>$lessonId))
	    ->find())
	    {
	        $this->error("参数异常！");
	    }
	    if(!M('appraiseStudentLesson')
	    ->where(array('uid'=>$loginUid,'lessonId'=>$lessonId))
	    ->find())
	    {
	        $this->error("参数异常！");
	    }
	    //查询课程可评价时段
	    $sessions=M('appraiseSession')
	    ->where(array('lessonId'=>$lessonId))
	    ->select();
	    $this->assign('uid',$uid);
	    $this->assign('lessonId',$lessonId);
	    $this->assign('sessions',$sessions);
	    $this->display();
	}
	public function doAppraise($uid=0,$lessonId=0,$sessionId=0,$point=0,$content='',$anonymous=0)
	{
	    //参数检查
	    
	    
	    $loginUid=is_login();//取得当前已登录用户的uid
	    if(!$loginUid)
	    {
	        $this->error("您尚未登录！",U("/ucenter/member/login"));
	    }
	    //权限检查
	    //判断是否重复评价
	    //判断当前时间是否在指定的session的时间段内
	    $appraise=M('appraise')->create();
	    $appraise['studentId']=$loginUid;
	    $appraise['teacherId']=$uid;
	    $appraise['createTime']=time();
	    M('appraise')->add($appraise);
	    $this->success("评价成功",U('index'));
	}
	public function showAppraise($uid=0)
	{
	    //参数检查
	    $uid = intval($uid);
	    if(!$uid)
	    {
	        $this->error("参数错误！");
	    }
	    $teacher = query_user(array('id', 'username', 'nickname', 'space_url', 'space_link', 'avatar64', 'rank_html', 'signature'), $uid);
	    $point=M("appraise")->where(array('teacherId'=>$uid))->avg('point');
	    $appraises=D("appraise")->relation('student')->where(array('teacherId'=>$uid))->select();
	    //var_dump($appraises);
	    $this->assign('teacher',$teacher);
	    $this->assign('point',$point);
	    $this->assign('appraises',$appraises);
	    $this->display();
	}
}



