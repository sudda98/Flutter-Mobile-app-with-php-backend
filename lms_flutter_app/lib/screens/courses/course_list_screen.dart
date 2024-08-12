import 'package:flutter/material.dart';

class CourseProvider with ChangeNotifier {
  List<Course> _courses = [];

  List<Course> get courses => _courses;

  Future<void> fetchCourses() async {
    // Implement your logic to fetch courses here
    // For now, let's just simulate some data
    await Future.delayed(Duration(seconds: 2));
    _courses = [
      Course(id: '1', title: 'Flutter Basics'),
      Course(id: '2', title: 'Advanced Flutter'),
    ];
    notifyListeners();
  }
}

class Course {
  final String id;
  final String title;

  Course({required this.id, required this.title});
}
