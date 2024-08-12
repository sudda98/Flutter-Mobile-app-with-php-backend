import 'package:flutter/material.dart';
import '../models/course.dart';

class CourseTile extends StatelessWidget {
  final Course course;

  CourseTile(this.course);

  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Text(course.title),
      subtitle: Text(course.description),
      trailing: course.isEnrolled
          ? Icon(Icons.check, color: Colors.green)
          : ElevatedButton(
              onPressed: () {
                // Handle course enrollment
              },
              child: Text('Enroll'),
            ),
      onTap: () {
        Navigator.pushNamed(
          context,
          '/course-detail',
          arguments: course.id,
        );
      },
    );
  }
}
