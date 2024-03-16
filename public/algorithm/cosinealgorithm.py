
import sys
import json
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Function to recommend posts


def recommend_posts(posts,  postContent):

# Vectorize posts and user profile separately for title and description
    postList  = json.loads(posts)
    data  = [key for key in postList.keys() if '&' not in key]

    vectorizer_title = TfidfVectorizer()
    title_texts = [post for post in data]
    post_title_vectors = vectorizer_title.fit_transform(title_texts)
    user_title_vector = vectorizer_title.transform([postContent])

    # # Combine title and description vectors using a weighted average
    alpha = 0.5  # Weight for title vectors

    post_vectors_combined = alpha * post_title_vectors
    user_vector_combined = alpha * user_title_vector

    # # Calculate cosine similarity between user profile and posts
    cosine_similarities = cosine_similarity(
        user_vector_combined, post_vectors_combined).flatten()

    # # Sort posts by similarity score
    post_indices_sorted = np.argsort(cosine_similarities)[::-1]

    # # Recommend top 3 posts
    top_n = 10
    recommended_posts = [(  postList[data[i]], cosine_similarities[i])
                         for i in post_indices_sorted[:top_n]
                       ]
    max_second_elements = {}

# Iterate over the data and update the dictionary with maximum second elements
    for pair in recommended_posts:
        first_element = pair[0]
        second_element = pair[1]
    
    # If the first element is not in the dictionary or the second element is greater than the current max
        if first_element not in max_second_elements or second_element > max_second_elements[first_element]:
            max_second_elements[first_element] = second_element
    filtered_list = [[key, value] for key, value in max_second_elements.items()]
    post_id_list = [pair[0] for pair in filtered_list]

    return post_id_list


if __name__ == "__main__":
    # # Get user profile and posts from command line arguments
    postContent = sys.argv[1]
    posts = sys.argv[2]
    # print(postContent)
    # Call function to recommend posts
    recommended_posts = recommend_posts(posts, postContent)

    # Output recommended posts as JSON
    print(json.dumps(recommended_posts))
    # print(posts)
