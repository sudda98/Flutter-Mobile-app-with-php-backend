class Course {
  final int id;
  final String title;
  final String description;
  final String category;
  final bool isEnrolled;

  Course({
    required this.id,
    required this.title,
    required this.description,
    required this.category,
    this.isEnrolled = false,
  });

  factory Course.fromJson(Map<String, dynamic> json) {
    return Course(
      id: json['id'],
      title: json['title'],
      description: json['description'],
      category: json['category'],
      isEnrolled: json['is_enrolled'] ?? false,
    );
  }
}
