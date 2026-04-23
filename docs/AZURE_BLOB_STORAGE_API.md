# Azure Blob Storage API Documentation

This document provides detailed instructions for using the Azure Blob Storage API endpoints in the `gom-api` project. These endpoints allow for single and multiple file uploads, deletions, and moving files between folders in Azure Blob Storage.

**Base URL:** `http://localhost:8001/api/v1/storage/azure-blob`

---

## 1. Single File Upload

Upload a single file to a specified folder in Azure Blob Storage.

- **URL:** `/upload/single`
- **Method:** `POST`
- **Content-Type:** `multipart/form-data`

### Request Body (Form-Data)

| Key | Type | Description |
| :--- | :--- | :--- |
| `file` | File | The file to upload (e.g., `Flower_2.jpg`). |
| `folderName` | String | (Optional) The target folder name. Defaults to `thearchivist-uploads`. |

### Example Response (200 OK)

```json
{
    "message": "Tải lên tệp đơn thành công",
    "data": {
        "originalFileName": "Flower_2.jpg",
        "fileUrl": "https://gomstorage1.blob.core.windows.net/thearchivist-uploads/test-single/flower-2.jpg"
    },
    "meta": {
        "timestamp": "2026-04-23T16:09:44+00:00",
        "path": "api/v1/storage/azure-blob/upload/single"
    }
}
```

---

## 2. Multiple Files Upload

Upload multiple files simultaneously to a specified folder.

- **URL:** `/upload/multiple`
- **Method:** `POST`
- **Content-Type:** `multipart/form-data`

### Request Body (Form-Data)

| Key | Type | Description |
| :--- | :--- | :--- |
| `files[]` | File[] | Array of files to upload. |
| `folderName` | String | (Optional) The target folder name. |

### Example Response (200 OK)

```json
{
    "message": "Tải lên nhiều tệp thành công",
    "data": {
        "files": [
            {
                "originalFileName": "Flower_2_1.jpg",
                "fileUrl": "https://gomstorage1.blob.core.windows.net/thearchivist-uploads/test-multiple/flower-2-1.jpg"
            },
            {
                "originalFileName": "Flower_2_2.jpg",
                "fileUrl": "https://gomstorage1.blob.core.windows.net/thearchivist-uploads/test-multiple/flower-2-2.jpg"
            }
        ]
    },
    "meta": {
        "timestamp": "2026-04-23T16:09:47+00:00",
        "path": "api/v1/storage/azure-blob/upload/multiple"
    }
}
```

---

## 3. Move Single File

Move (rename) a single file from its current path to a new folder.

- **URL:** `/move/single`
- **Method:** `PUT`
- **Content-Type:** `application/json`

### Request Body (JSON)

```json
{
    "sourceKey": "test-single/flower-2.jpg",
    "destinationFolder": "test-single-moved"
}
```

### Example Response (200 OK)

```json
{
    "message": "Di chuyển tệp thành công",
    "data": "Tệp đã được di chuyển từ: test-single/flower-2.jpg đến thư mục: test-single-moved",
    "meta": {
        "timestamp": "2026-04-23T16:09:50+00:00",
        "path": "api/v1/storage/azure-blob/move/single"
    }
}
```

---

## 4. Move Multiple Files

Move multiple files to a new folder.

- **URL:** `/move/multiple`
- **Method:** `PUT`
- **Content-Type:** `application/json`

### Request Body (JSON)

```json
{
    "sourceKeys": [
        "test-multiple/flower-2-1.jpg",
        "test-multiple/flower-2-2.jpg"
    ],
    "destinationFolder": "test-multiple-moved"
}
```

### Example Response (200 OK)

```json
{
    "message": "Di chuyển nhiều tệp thành công",
    "data": "Các tệp đã được di chuyển tới thư mục: test-multiple-moved",
    "meta": {
        "timestamp": "2026-04-23T16:09:53+00:00",
        "path": "api/v1/storage/azure-blob/move/multiple"
    }
}
```

---

## 5. Delete Single File

Delete a single file from Azure Blob Storage.

- **URL:** `/delete/single`
- **Method:** `DELETE`
- **Content-Type:** `application/json`

### Request Body (JSON)

```json
{
    "filePath": "test-single-moved/flower-2.jpg"
}
```

### Example Response (200 OK)

```json
{
    "message": "Xóa tệp thành công",
    "meta": {
        "timestamp": "2026-04-23T16:09:55+00:00",
        "path": "api/v1/storage/azure-blob/delete/single"
    }
}
```

---

## 6. Delete Multiple Files

Delete multiple files from Azure Blob Storage.

- **URL:** `/delete/multiple`
- **Method:** `DELETE`
- **Content-Type:** `application/json`

### Request Body (JSON)

```json
{
    "filePaths": [
        "test-multiple-moved/flower-2-1.jpg",
        "test-multiple-moved/flower-2-2.jpg"
    ]
}
```

### Example Response (200 OK)

```json
{
    "message": "Xóa nhiều tệp thành công",
    "meta": {
        "timestamp": "2026-04-23T16:09:57+00:00",
        "path": "api/v1/storage/azure-blob/delete/multiple"
    }
}
```

---

## Error Handling

All APIs return a JSON response with a `message` field in case of error (HTTP Status `400` or `422`).

**Example Validation Error (422):**
```json
{
    "message": "The file failed to upload.",
    "errors": {
        "file": [
            "The file failed to upload."
        ]
    }
}
```

**Note:** Ensure that the `Accept: application/json` header is included in all requests to receive JSON error responses instead of redirects.
